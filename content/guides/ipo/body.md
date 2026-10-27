`n` projects (up to 1e5). Project `i` needs at least `capital[i]` to start and adds `profits[i]` to your capital when done (capital is never spent). Start with `w`; finish at most `k` distinct projects. Return the largest final capital. `k = 2`, `w = 0`, `profits = [1,2,3]`, `capital = [0,1,1]` → 4. `k = 3`, `w = 0`, `[1,2,3]`, `[0,1,2]` → 6.

## Two heaps: affordable and best

Sort projects by required capital (or put them in a min-heap by capital). Keep a max-heap of profits for projects you can afford now. Repeat up to `k` times: move every project with `capital <= w` into the profit heap; if it is empty, stop; otherwise pop the largest profit and add it to `w`.

Greedy is safe here: profits are never negative and capital only grows, so taking the most profitable affordable project never shrinks your future options — anything affordable now stays affordable.

Course Schedule III (630) is another sort-plus-heap greedy. Maximum Profit in Job Scheduling (1235) uses DP because jobs conflict in time.

Do not sort by profit alone — the top project may be unaffordable. Do not rescan all projects each round (O(n k)); the sorted pointer moves forward only once overall.

Time: O(n log n + k log n)  
Space: O(n)

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
