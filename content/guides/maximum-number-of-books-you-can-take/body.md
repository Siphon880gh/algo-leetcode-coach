You are given an array books, where books[i] is the number of books on shelf i. You take books from a contiguous range of shelves l … r. From each shelf i in the range you take at most books[i] books, and for every i < r you must take strictly fewer books from shelf i than from shelf i + 1. Return the maximum number of books you can take. For instance, [8,5,2,7,9] → 19; [7,0,3,4,5] → 12; [8,2,3,7,3,4,0,1,4,3] → 13. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Arithmetic run, then jump

1. `a[i] = books[i] − i`; stack of indices with increasing `a`.
2. For each `i`: pop while `a[top] ≥ a[i]`.
   - Stack empty: `dp[i] = S(books[i], i + 1)`.
   - Else with `j = top`: `dp[i] = dp[j] + S(books[i], i − j)`.
   - `S(t, c)` sums `t, t − 1, …` over `min(t, c)` terms.
3. Return `max dp`, using 64-bit sums.

Constructed checks (verified against trying every right end with a greedy walk left on 500 random arrays): the cases above → 19, 12, 13.

Ending at i with books[i] taken is optimal for that right end. Shelf k < i would get books[i] − (i − k), which fits while books[k] ≥ that, i.e. a[k] ≥ a[i]. At the first shelf j with a[j] < a[i] the cap binds, and from there the best is dp[j].

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
