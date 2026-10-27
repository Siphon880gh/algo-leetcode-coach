`n` cities and `k` weeks (both up to 100). `flights[i][j] = 1` means you can fly from city `i` to city `j`. `days[i][w]` is the most vacation days you can take in city `i` during week `w`. You start in city 0. Every Monday you may take one flight or stay put, then spend that week where you are. Return the most vacation days in total. `flights = [[0,1,1],[1,0,1],[1,1,0]]`, `days = [[1,3,1],[6,0,3],[3,3,3]]` → 12 (fly to city 1 for 6, then city 2 for 3, then stay for 3). _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## DP by week

`f[w][j]` = most vacation days after `w` weeks, ending the week in city `j`. Set `f[0][0] = 0` and every other city to −∞.

For week `w` from 1 to `k` and each city `j`:

`f[w][j] = days[j][w − 1] + max(f[w − 1][j], max over i with flights[i][j] = 1 of f[w − 1][i])`

The answer is `max_j f[k][j]`. You only need the previous row, so one rolling array is enough.

Do not forget that staying is always allowed, even though `flights[j][j]` is 0. Do not start from every city; only city 0 is reachable at week 0.

Time: O(k · n²)  
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
