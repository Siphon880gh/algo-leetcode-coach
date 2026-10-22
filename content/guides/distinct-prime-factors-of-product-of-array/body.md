## Union of factors

1. For each `x`: for `p = 2 …` while `p² ≤ x`, add `p` and divide it out whenever it divides; if `x > 1` afterwards, add `x`.
2. Return the set’s size.

Examples → 4, 1.

The product of 10^4 numbers up to 1000 has about 30,000 digits, so forming it is wasteful. Each trial division takes at most about 31 steps.

Time: O(n · √max)  
Space: O(number of primes below 1000)

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
