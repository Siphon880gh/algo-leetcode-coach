## Two independent permutations

1. `p` = number of primes in `1..n` (a sieve or trial division; n ≤ 100).
2. Return `p! · (n − p)! mod (10⁹ + 7)`, reducing after each multiplication.

`n = 5`: primes 2, 3, 5 → 3! · 2! = 12.

Do not count 1 as prime. Do not compute the full factorials and reduce at the end in a fixed-width language; they overflow.

Time: O(n log log n)  
Space: O(n)

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
