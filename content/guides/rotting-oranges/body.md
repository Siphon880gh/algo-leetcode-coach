## All rotten oranges start together

1. Enqueue every `2`; count every `1` as `fresh`.
2. `minutes = 0`. While the queue is non-empty and `fresh > 0`:
   - For each orange in the current level, rot each fresh neighbor (set to 2, `fresh −= 1`, enqueue).
   - `minutes += 1`.
3. Return `minutes` if `fresh == 0`, else −1.

Stopping when `fresh` reaches 0 avoids counting an extra minute for the last level.

Do not BFS from each rotten orange separately; they spread at the same time. Do not forget the case with no fresh oranges: the answer is 0.

Time: O(m · n)  
Space: O(m · n)

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
