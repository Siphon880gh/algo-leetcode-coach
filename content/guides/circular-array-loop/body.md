## Floyd on each start, with a sign check

`next(i) = ((i + nums[i]) % n + n) % n`. For each start `i` that is not marked dead: run `slow = i`, `fast = next(i)`. Keep going while `nums[fast]` and `nums[next(fast)]` have the same sign as `nums[i]`. If `slow == fast`, check `slow != next(slow)` — a self-loop has length 1 and does not count. If it is longer, return true.

After a start fails, walk its path again from `i` and set each visited value to 0 while the sign stays the same. Zero means "cannot be part of an answer", so no index is explored twice. That keeps the total O(n) with O(1) extra space.

Linked List Cycle (141 / 142) is the plain Floyd idea. Find the Duplicate Number (287) uses Floyd on index jumps too.

Do not accept a cycle that mixes directions. Do not accept a self-loop. Do not forget the double modulo — `i + nums[i]` can be negative.

Time: O(n)  
Space: O(1)

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
