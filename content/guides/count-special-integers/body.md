## Shorter lengths, then a prefix walk

1. For lengths `L < len(n)`: add `9 · P(9, L − 1)`.
2. For each position `i` of n with digit `d`: add `P(10 − i − 1, len − i − 1)` for every unused digit below `d` (not 0 at position 0).
3. If `d` was already used, stop; otherwise mark it. If the walk finishes, add 1 for n itself.

Examples → 19, 5, 110. Checked against a direct count for every n below 3000.

P(a, b) counts ordered choices of b distinct digits from a. n = 2 · 10^9 gives 5,974,650, so 32-bit is fine.

Time: O(len²)  
Space: O(10)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Algo Learning IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
