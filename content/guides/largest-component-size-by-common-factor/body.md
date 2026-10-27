## Primes as meeting points

Comparing every pair is O(n²) gcds. Instead, let factors be the hubs.

1. Union-find over values up to `max(nums)`.
2. For each `x`, factor it by trial division up to `√x` (or with a smallest-prime-factor sieve). Union `x` with each prime factor `p`.
3. Count `find(x)` over all `x` in `nums`; return the largest count.

Two numbers that share a prime end up under the same root through that prime, and chains of shared primes merge whole groups.

Only count the numbers from `nums`, not the prime nodes.

Do not test all pairs with gcd; n is up to 2·10⁴. Do not union `x` with every divisor; primes are enough.

Time: O(n · √max) with trial division, about O(n log max) with a sieve  
Space: O(max)

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
