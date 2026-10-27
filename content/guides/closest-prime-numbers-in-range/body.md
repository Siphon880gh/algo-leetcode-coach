## Sieve and scan

1. Sieve of Eratosthenes up to `right`; 0 and 1 are not prime.
2. Walk the primes in `[left, right]`; for each consecutive pair, keep it if its gap is strictly smaller than the best.
3. Return the best pair, or [−1, −1] with fewer than two primes.

Examples → [11,13], [−1,−1].

A strict comparison keeps the smallest num1 on ties. Once a gap of 2 is found nothing can beat it except 2 and 3, so you may stop early. The sieve up to 10^6 takes about 2.5 · 10^6 steps.

Time: O(right log log right)  
Space: O(right)

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
