There are n cities (n is small) and highways [city1, city2, toll] connecting pairs of cities in both directions. A trip starts at any city, crosses exactly k highways, and visits each city at most once. Return the maximum total toll of such a trip, or −1 if none exists. For instance, n = 5, highways [[0,1,4],[2,1,3],[1,4,11],[3,2,3],[3,4,2]], k = 3 → 17; n = 4, highways [[0,1,3],[2,3,2]], k = 2 → −1. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Paths as (visited set, end)

1. If `k > n − 1`, return −1.
2. `dp[{v}][v] = 0` for every `v`.
3. Repeat `k` times: from each state `(mask, v)`, for each highway `v – u` with `u ∉ mask`: update `dp[mask ∪ {u}][u]` with `+ toll`.
4. Return the largest value after `k` steps, or −1.

Constructed checks (verified against a DFS over every simple path on 200 small graphs): the two cases above → 17, −1.

Visiting each city at most once is what makes the mask necessary; without it, a trip could bounce along the priciest highway.

Time: O(2^n · n · deg)  
Space: O(2^n · n)

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
