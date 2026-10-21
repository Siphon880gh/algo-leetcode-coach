## Mark and check

1. `d[start] += 1`, `d[end + 1] −= 1` for each range.
2. Running sum; for `x` in `[left, right]`, the sum must be positive.

`[[1,2],[3,4],[5,6]], 2, 5` → true. `[[1,10],[10,20]], 21, 21` → false.

Ranges are inclusive, so the decrement goes at `end + 1`. Sorting ranges and sweeping `left` forward also works for large values.

Time: O(n + 50)  
Space: O(50)

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
