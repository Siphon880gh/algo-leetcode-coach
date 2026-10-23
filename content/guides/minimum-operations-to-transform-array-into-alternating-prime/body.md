## Sieve

1. Sieve primes up to 100,003, the first prime above 10^5.
2. Even i: add (next prime ≥ nums[i]) − nums[i].
3. Odd i: non-prime → 0; 2 → 2 (3 is prime); other primes → 1.

Examples → 3, 0, 1. Checked against stepping up one at a time on 3,000 random arrays.

Always adding 1 for a prime at an odd index: example 1 → 2 instead of 3.

Time: O(V log log V + n), V = 100,003  
Space: O(V)

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
