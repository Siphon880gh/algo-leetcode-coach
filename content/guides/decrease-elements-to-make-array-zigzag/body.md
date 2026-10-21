## Lower the valleys

For `start` in `{0, 1}`: `cost = 0`; for each `i` with `i % 2 == start`:

- `m` = the smaller of the existing neighbours `nums[i − 1]`, `nums[i + 1]`.
- `cost += max(0, nums[i] − m + 1)`.

Return the smaller of the two costs.

Only the valleys need to change; lowering a peak never helps, so each valley's cost depends only on its original neighbours.

Do not modify the array while computing the first pattern and then reuse it for the second; compute both from the original values.

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
