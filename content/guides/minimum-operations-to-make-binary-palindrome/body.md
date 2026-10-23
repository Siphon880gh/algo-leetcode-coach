## Precompute and search

1. pal = sorted x < 2^14 whose binary reads the same both ways.
2. For each x: i = bisect_left(pal, x); answer = min(pal[i] − x, x − pal[i − 1]) over the ones that exist.

Examples → [0, 1, 1], [1, 0, 3]. Checked against a full scan for every x from 1 to 5000.

Only rounding down: constructed check (run in code) 14 → 5 instead of 1 (15 is a palindrome).

Time: O(2^14 + n log P)  
Space: O(P)

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
