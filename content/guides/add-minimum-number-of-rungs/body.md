## Per-gap formula

`prev = 0`; for each rung `r`: `ans += (r − prev − 1) // dist`; `prev = r`.

`[1,3,5,10], 2` → 2. `[3,6,8,10], 3` → 0. `[3,4,6,7], 2` → 1.

The `− 1` handles gaps that are exact multiples of `dist`: a gap of 4 with `dist = 2` needs one rung, not two. Gaps are independent, so greedy is optimal.

Time: O(n)  
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
