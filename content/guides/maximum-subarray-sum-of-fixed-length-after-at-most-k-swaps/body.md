You get nums (length up to 300, values from −10^9 to 10^9), a window length, and k. You may do at most k swaps, each exchanging any two elements. Return the largest possible sum of a subarray of exactly that length. Example: nums = [1, −1, 0, 2], length = 2, k = 1 gives 3 by swapping −1 and 2 to get [1, 2, 0, −1]. _(Restated in my own words; the full statement shows when premium is unlocked.)_

## Example first

nums = [4, 3, 2, 4], length = 3, k = 2.

1. Window [4, 3, 2] sums to 9. Outside it is the last 4.
2. Swap the 2 inside with the 4 outside: the window becomes [4, 3, 4] with sum 11.
3. No outside value is left to trade, so the second swap is unused. Answer 11.

## Idea

Fix a window. Swapping two elements that are both inside, or both outside, leaves its sum alone. Only a trade across the edge changes it, and the best trades put the largest outside values in place of the smallest inside values. There are at most min(k, length, n − length) useful trades.

## Steps

1. For each window start i, sort the inside values ascending and the outside values descending.
2. For j = 0, 1, … up to the trade limit: gain = outside[j] − inside[j]. Stop at the first gain ≤ 0; otherwise add it.
3. The answer is the best window total.

## Trap

Ignoring k. With nums = [4, 0, 2], length = 2, k = 0, taking the two largest values gives 6 instead of 4. Fix: cap the trades at k.

Checked: the examples give 3, 11 and −3, and the method matched a search over every sequence of up to k swaps on 200 random small cases.

Time: O(n² log n)  
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
