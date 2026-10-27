## Sweep r

1. p = previous index of nums[r] (or −1). S = sum of counts over left ends p + 1 … r, then add 1 to them.
2. `cur += 2·S + (r − p)`; `ans += cur`.
3. Return ans mod 10^9 + 7.

Examples → 15, 3. Checked against counting every subarray on 400 random arrays.

The square of c + 1 is c² + 2c + 1, which is why only the range sum is needed. n reaches 10^5, so the O(n²) way from part I is about 5 · 10^9 subarrays.

Time: O(n log n)  
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
