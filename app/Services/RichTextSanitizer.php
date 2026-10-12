<?php

namespace App\Services;

use DOMDocument;
use DOMElement;
use DOMNode;
use DOMText;

class RichTextSanitizer
{
    /**
     * @var list<string>
     */
    private const ALLOWED_TAGS = ['p', 'br', 'strong', 'b', 'em', 'i', 'u', 's', 'ol', 'ul', 'li', 'blockquote'];

    /**
     * @var list<string>
     */
    private const DISCARDED_TAGS = ['script', 'style', 'iframe', 'object', 'svg', 'math', 'template'];

    public function sanitize(string $html): string
    {
        $document = new DOMDocument('1.0', 'UTF-8');
        $previousErrorHandling = libxml_use_internal_errors(true);

        $document->loadHTML(
            '<!DOCTYPE html><html><head><meta charset="UTF-8"></head><body><div id="rich-text-root">'.$html.'</div></body></html>',
            LIBXML_HTML_NODEFDTD | LIBXML_NONET,
        );

        libxml_clear_errors();
        libxml_use_internal_errors($previousErrorHandling);

        $root = $document->getElementById('rich-text-root');

        if ($root === null) {
            return '';
        }

        $safeHtml = '';

        foreach ($root->childNodes as $child) {
            $safeHtml .= $this->sanitizeNode($child);
        }

        return $safeHtml;
    }

    private function sanitizeNode(DOMNode $node): string
    {
        if ($node instanceof DOMText) {
            return htmlspecialchars($node->nodeValue ?? '', ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
        }

        if (! $node instanceof DOMElement) {
            return '';
        }

        $tag = strtolower($node->tagName);

        if (\in_array($tag, self::DISCARDED_TAGS, true)) {
            return '';
        }

        $children = '';

        foreach ($node->childNodes as $child) {
            $children .= $this->sanitizeNode($child);
        }

        if (! \in_array($tag, self::ALLOWED_TAGS, true)) {
            return $children;
        }

        if ($tag === 'br') {
            return '<br>';
        }

        return "<{$tag}>{$children}</{$tag}>";
    }
}
