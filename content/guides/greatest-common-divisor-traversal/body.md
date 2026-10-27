## Primes as hubs

1. If n = 1, return true; if any value is 1, return false.
2. Factor each value; union its index with every prime it contains.
3. Return whether all indices share one root.

Examples → true, false, true. Checked against a search over all gcd links on 1000 random arrays.

Linking pairs directly needs O(n²) gcds, too slow for n = 10^5; a prime node joins everything that shares it at once. A 1 shares no prime with anything, so it isolates its index.

Time: O(n · √max) with trial division, faster with a smallest-prime sieve  
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
