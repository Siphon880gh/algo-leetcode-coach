## Ranges per prime

1. Sieve primes up to 10^5. For each prime value keep a sorted set of its positions.
2. Its range is [first + 1, last] when it appears at least twice; add +1 there in a range-add, max segment tree over k = 1 … n − 1.
3. Update: remove the old value’s range, change its positions, add the new range; do the same for the new value.
4. Answer = number of primes present + the tree’s maximum.

Examples → [3, 4], [0]. Checked against trying every split on 300 random cases.

Counting distinct primes of the whole array, ignoring the split: example 1 → [2, 2] instead of [3, 4].

Time: O((n + q) log n)  
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
