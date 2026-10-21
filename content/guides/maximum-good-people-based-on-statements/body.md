## Only good people constrain

1. For `mask` in `0 … 2^n − 1`:
2. For each `i` in `mask` and each `j`: if `statements[i][j] ≠ 2` and it differs from bit `j` of `mask`, reject.
3. Track the largest popcount of an accepted mask.

Examples → 2, 1.

Bad people may say anything, so their statements never rule a mask out. Good people tell the truth, so each of their claims must match the guess, including claims about themselves.

Time: O(2^n · n²)  
Space: O(1)

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
