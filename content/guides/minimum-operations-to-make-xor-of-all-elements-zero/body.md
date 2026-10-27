You get an array nums of positive integers, each at most 2000, with length up to 10^5. One move picks two indices whose values differ and replaces one of them with their XOR. Return the fewest moves that make the XOR of the whole array 0, or −1 if it can never happen. Example: [8, 1, 4, 8, 2] needs 3 moves, [1, 2, 3] needs 0, and [1, 2, 4] is impossible. _(Restated in my own words; the full statement shows when premium is unlocked.)_

## Example first

nums = [8, 1, 4, 8, 2]. The total is X = 8 ^ 1 ^ 4 ^ 8 ^ 2 = 7.

1. Replacing nums[i] with nums[i] ^ nums[j] changes the total to X ^ nums[j]: the value you keep is XORed in one more time.
2. 7 is not in the array, so one move cannot finish.
3. No two values XOR to 7 either.
4. 1 ^ 4 ^ 2 = 7, so three moves work. Answer 3.

## The rule

The answer is the smallest number of elements (different indices) whose XOR equals X. Those elements are exactly what the moves fold away; the rest of the array already XORs to 0. If every element is needed, the elements are independent and the total can never reach 0.

## Steps

1. X = XOR of all elements. If X = 0, return 0.
2. BFS over the 2048 possible XOR values. Start at 0; from v, step to v ^ a for every distinct value a. dist[v] is the fewest elements that XOR to v. Using a value twice cancels, so the BFS never needs it.
3. If X is unreachable or dist[X] = n, return −1. Otherwise return dist[X].

## Trap

Stopping after one move: X = 7 is not in [8, 1, 4, 8, 2], so you return −1 instead of 3. Fix: search for the fewest values, not just one.

Checked: the examples give 3, 0 and −1, and the BFS matched a search over whole arrays on 250 random small cases.

Time: O(2048 · D) with D ≤ 2000 distinct values  
Space: O(2048)

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
