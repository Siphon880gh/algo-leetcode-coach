## Binary

1. ⌊x / 2^25⌋ copies of 'z'; x = x mod 2^25.
2. For j = 24 … 0: if bit j is set, append 'a' + j.

Examples → ["b", "ca", "cba"], ["ba", "da", "a"]. Matched breadth-first search over merges for x ≤ 14. x = 10^8 → "zzyxwv…", 13 letters.

Writing the bits from the lowest one first: 5 → "ac" instead of "ca".

Time: O(n · 26)  
Space: O(26) per string

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
