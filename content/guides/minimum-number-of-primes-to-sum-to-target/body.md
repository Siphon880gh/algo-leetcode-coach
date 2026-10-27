Given n and m, pick primes from the first m primes, each usable any number of times, so that they sum to exactly n. Return the fewest primes needed, or −1 if it cannot be done. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Coin change

1. primes = the first m primes (sieve or trial division).
2. dp[0] = 0; dp[s] = 1 + min dp[s − p] over primes p ≤ s.
3. Answer dp[n], or −1 if unreachable.

Constructed checks (run in code): n = 1, m = 5 → −1; n = 11, m = 2 → 4; n = 6, m = 1 → 3; n = 9, m = 1 → −1. Checked against trying every multiset for n ≤ 25 and m ≤ 5. This assumes n and m are small enough for an O(n · m) table.

Taking the largest prime first: n = 4, m = 2 → −1 instead of 2.

Time: O(n · m)  
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
