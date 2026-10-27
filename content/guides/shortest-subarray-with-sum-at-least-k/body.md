## Best start for each end

Let `P[0] = 0` and `P[i + 1] = P[i] + nums[i]`. You want the smallest `j − i` with `P[j] − P[i] ≥ k`.

Walk `j` from 0 to `n` with a deque of indices:

1. While the deque is non-empty and `P[j] − P[front] ≥ k`: record `j − front`, pop the front. A later `j` would only give a longer window for that start.
2. While the deque is non-empty and `P[back] ≥ P[j]`: pop the back. `j` is later and no larger, so it is always a better start.
3. Push `j`.

Return the best length, or −1.

Every index enters and leaves once.

Do not use a two-pointer window; with negative numbers, shrinking can raise the sum. Do not forget `P[0] = 0`, or subarrays starting at index 0 are missed.

Time: O(n)  
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
