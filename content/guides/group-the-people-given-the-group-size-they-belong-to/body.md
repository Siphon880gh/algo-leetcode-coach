## Emit full buckets

1. For each person `i` with size `s`, append `i` to `bucket[s]`.
2. If `bucket[s]` has `s` people, add it to the answer and clear it.

`[3,3,3,3,3,1,3]` → `[[0,1,2],[5],[3,4,6]]`. `[2,1,3,3,3,2]` → `[[1],[2,3,4],[0,5]]`. Any valid grouping in any order is accepted.

Do not put more than `s` people in one group. Do not wait until the end to split; emitting as you go is simpler.

Time: O(n)  
Space: O(n)

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
