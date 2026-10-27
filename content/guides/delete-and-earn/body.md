## Reduce to a known problem

Once you take value `v`, you might as well take every copy of it; its neighbors `v − 1` and `v + 1` are already gone. So build `points[v] = v · count(v)`.

Now choosing values is House Robber on the line `0 … max`: you cannot take two adjacent values.

`take, skip = 0, 0`. For `v` from 0 to `max`: `take, skip = skip + points[v], max(take, skip)`. Answer: `max(take, skip)`.

If values are sparse, sort the distinct values instead. When the next value is exactly `v + 1`, use the robber rule; when there is a gap, the previous best carries over freely.

Do not choose greedily by largest value; `[2,2,3,3,3,4]` → 9 by taking all three 3s. Do not treat elements one by one; copies must be grouped.

Time: O(n + max)  
Space: O(max)

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
