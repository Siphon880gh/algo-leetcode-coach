You get nums (length n), k, a first query [l0, r0], and a query count q. A subarray is valid when it has exactly k distinct values and every value in it appears an even number of times. Queries are made one at a time: after answering query i, let g = l + r if it was valid and g = r − l otherwise; the next query is l' = (l XOR g) mod n and r' = (r XOR g) mod n, swapped if l' > r'. Return the q answers as booleans. Example: nums = [1, 2, 2, 1], k = 2, l0 = 1, r0 = 2, q = 2 gives [false, true]. n and q go up to 5 × 10^5. _(Restated in my own words; the full statement shows when premium is unlocked.)_

## Example first

nums = [1, 2, 2, 1], k = 2, first query [1, 2].

1. Query 0 is [2, 2]. Every count is even, but there is only 1 distinct value, so the answer is false.
2. g = 2 − 1 = 1, so the next query is [1 XOR 1, 2 XOR 1] = [0, 3].
3. Query 1 is [1, 2, 2, 1]. Two distinct values, each twice, so the answer is true.

Query i + 1 is built from answer i, so you cannot sort the queries and sweep offline. Each check has to be O(1) or O(log n).

## Two checks per query

1. **All counts even.** Give every value a random 64-bit code and build prefix XORs H. Equal codes cancel in pairs, so every count in [l, r] is even exactly when H[r + 1] = H[l] (up to a tiny collision chance).
2. **Exactly k distinct.** Let prev[i] be the last index before i with the same value (−1 if none). Index i is the first copy of its value inside [l, r] exactly when prev[i] < l, so distinct(l, r) = how many i in [l, r] have prev[i] < l. A persistent segment tree over prev, one version per prefix, answers that online in O(log n).
3. Answer the query, compute g, and build the next [l, r].

## Trap

Checking only the even counts. Example 1's first query [2, 2] is all even, so you answer true, and that wrong answer also changes every later query: you get [true, true] instead of [false, true]. Fix: also require exactly k distinct values.

Checked: both examples match, and the method matched a direct recount on 300 random small cases.

Time: O((n + q) log n)  
Space: O(n log n)

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
