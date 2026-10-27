## Window

1. Sieve primes. For each r: if nums[r] is prime, push it on the max and min deques and record its position.
2. While max − min > k, advance l and drop stale deque fronts.
3. If at least two primes are recorded and the second-to-last p2 ≥ l, add p2 − l + 1.

Examples → 2, 4. Checked against every subarray on 400 random arrays.

Using max − min of all elements, not just primes: example 1 → 1 instead of 2.

Time: O(n + max)  
Space: O(n + max)

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
