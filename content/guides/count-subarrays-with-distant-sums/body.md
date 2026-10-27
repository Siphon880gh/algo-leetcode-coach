## Example first

nums = [1, 2, 1], goal = 4, k = 1.

The six subarray sums are 1, 2, 1, 3, 3, 4. Only the whole array (sum 4) is closer than 1 to the goal. So 6 − 1 = 5 subarrays are distant.

## Idea

Distant means |sum − goal| ≥ k. The opposite, goal − k < sum < goal + k, is an open window, which is easy to count with prefix sums. With prefix sums s, sum(i … j) = s[j + 1] − s[i]. For a right prefix v, the left prefix u must satisfy v − goal − k < u < v − goal + k.

## Steps

1. Build s[0 … n] and sort a copy to compress values.
2. Start with ans = n(n + 1) / 2.
3. Walk the prefixes in order. For each v, count earlier prefixes in [v − goal − k + 1, v − goal + k − 1] with a Fenwick tree and subtract. Then insert v.
4. When k = 0 the window is empty and every subarray is distant.

## Trap

Using a strict "> k". |3 − 4| = 1 is distant for k = 1, so the strict test gives 3 instead of 5 on Example 1. Fix: distant includes equality.

Checked: the examples give 5, 2 and 2, and the count matched checking every subarray on 300 random arrays.

Time: O(n log n)  
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
