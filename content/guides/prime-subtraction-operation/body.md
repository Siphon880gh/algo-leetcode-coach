## Shrink each value greedily

1. Sieve the primes below 1000; `prev = 0`.
2. For each `x`: find the largest prime `p < x` with `x − p > prev`. If one exists, `prev = x − p`; else if `x > prev`, `prev = x`; else return false.
3. Return true.

Examples → true, true, false. Checked against trying every prime choice on 300 random arrays.

A smaller value only helps the elements after it, so the smallest valid value is always the right choice. A binary search over the prime list finds p quickly, though a scan is fine for 1000.

Time: O(n · π(1000))  
Space: O(π(1000))

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
