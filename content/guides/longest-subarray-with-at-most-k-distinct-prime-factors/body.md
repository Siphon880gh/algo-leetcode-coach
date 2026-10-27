## Window

1. Sieve: primes[v] = distinct prime factors of v, for v ≤ 10^5.
2. Add primes[nums[r]] to cnt. While len(cnt) > k, remove primes[nums[l]] and l += 1.
3. answer = max(r − l + 1).

Examples → 3, 4, 1. Matched checking every subarray on 1,500 random arrays.

Adding each element's prime count instead of taking the union: example 1 → 2 instead of 3.

Time: O(V log log V + n · ω), ω ≤ 6 distinct primes per value  
Space: O(V log log V)

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
