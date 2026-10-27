## One pointer per list

1. Push the first value of each list into a min-heap as `(value, list, index)`, and set `mx` to the largest of them.
2. Loop:
   - The heap top `(lo, i, j)` and `mx` give a range `[lo, mx]` that holds one value from every list. Keep it if it is smaller than the best one (a smaller width, or the same width with a smaller start).
   - If list `i` has no value after `j`, stop.
   - Otherwise push `lists[i][j + 1]` and update `mx`.

Only advancing the minimum can shrink the range, since the max can only grow.

Another route is to merge every value with its list id, sort, and run a sliding window that covers all k lists; that is O(N log N) as well.

Do not advance the list holding the max; the minimum is what limits the range. Do not stop when one list reaches its last value; stop when you would need to move past it.

Time: O(N log k) for N total values  
Space: O(k)

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
