## Shortest first

1. pairs = Σ ⌊count(c) / 2⌋ over all letters.
2. Sort word lengths ascending. For each L: if pairs ≥ ⌊L/2⌋, use them and count the word; else stop.

Examples → 3, 2, 1. Checked against trying every arrangement of the letters on 250 random small inputs.

Middle letters never run short: the letters not used in pairs are exactly enough to fill every remaining position, since the total length is fixed.

Longest first is wrong: ['ad', 'dc', 'cbdc'] has 2 pairs; shortest first makes 2 palindromes, longest first only 1.

Time: O(total length + n log n)  
Space: O(n)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Leetcode Practice Coach IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
