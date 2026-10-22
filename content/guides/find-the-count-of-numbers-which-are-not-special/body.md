## Prime squares

1. Sieve primes up to ⌊√r⌋ (at most 31,622).
2. Return (r − l + 1) − #{p : l ≤ p² ≤ r}.

Examples → 3, 11. Checked against counting divisors for 100 random ranges below 300.

Treating every perfect square as special: example 2 → 10 instead of 11, since 16 has proper divisors 1, 2, 4, 8.

Time: O(√r log log r)  
Space: O(√r)

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
