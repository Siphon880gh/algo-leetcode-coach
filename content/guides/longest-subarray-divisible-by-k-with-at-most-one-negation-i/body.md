## Example first

nums = [4, 1, 2], k = 3.

1. The whole sum is 7, and 7 mod 3 = 1.
2. Negating 2 lowers the sum by 2 · 2 = 4, giving 3, which is divisible by 3.
3. The whole array is valid, so the answer is 3.

## Idea

Negating x changes the sum of every subarray that contains it by −2x and leaves the others alone. n ≤ 1000, so try every index as the negated one, plus no negation, and solve "longest subarray with sum divisible by k" for each version.

## Steps

1. longest(arr): first[0] = −1. Walk the prefix remainders. If remainder s was seen, the subarray after its first index has a sum divisible by k, so update with i − first[s]. Otherwise store first[s] = i.
2. ans = longest(nums).
3. For each i: set nums[i] = −nums[i], ans = max(ans, longest(nums)), then restore it.

In languages where % can be negative, normalize with ((s % k) + k) % k.

## Trap

Never negating. Example 1 then gives 2 instead of 3, and Example 3 gives 0 instead of 2. Fix: try every negated index.

Checked: the examples give 3, 2 and 2, and the scans matched trying every subarray and every negation on 300 random arrays.

Time: O(n²)  
Space: O(min(n, k))

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
