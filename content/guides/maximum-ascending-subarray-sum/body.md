## One pass

1. `cur = best = nums[0]`.
2. For `i ≥ 1`: `cur = cur + nums[i]` if `nums[i] > nums[i − 1]`, else `nums[i]`; `best = max(best, cur)`.

`[10,20,30,5,10,50]` → 65. `[10,20,30,40,50]` → 150. `[12,17,15,13,10,11,12]` → 33.

Equal neighbours break the run; the statement requires strictly increasing.

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
