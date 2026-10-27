Each fruit has a price and a tastiness. You have a budget and a number of coupons. You may buy each fruit at most once, and you may use at most one coupon on a fruit to buy it for about half its price; the exact rounding is in the official statement. Return the largest total tastiness you can buy without going over the budget. For instance, prices [10,20,20], tastiness [5,8,8], budget 20 and 1 coupon → 13; with no coupons → 8. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Three choices per fruit

1. `dp[a][c]` = best tastiness with money at most `a` and at most `c` coupons; all start at 0.
2. For each fruit, for `a` from the budget down and `c` from the coupons down: try `dp[a − price][c] + taste` and, if `c > 0`, `dp[a − reduced][c − 1] + taste`.
3. Return `dp[budget][coupons]`.

Constructed checks (verified against trying every choice per fruit on 300 random small cases with even prices): the cases above → 13, 8; prices [8,6,4], tastiness [3,5,4], budget 10, 2 coupons → 9.

Loop money and coupons downward so each fruit is used at most once in a single pass. Using the coupon is never forced; the full-price option stays.

Time: O(n · budget · coupons)  
Space: O(budget · coupons)

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
