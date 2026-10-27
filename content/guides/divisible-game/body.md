## Prime candidates

1. Candidates: every prime factor of every element, plus the smallest prime dividing no element.
2. For each candidate k in increasing order: Kadane on (x if k divides x else −x); keep the first k with the best value.
3. Return best · k mod 10^9 + 7, taking a negative best to its non-negative residue.

Examples → 36, 6, 1000000005. Checked against trying every k up to max + 2 on 1,500 random arrays.

Trying only k = 2: constructed check (run in code) [3] → 1000000001 instead of 9.

Time: O(n · √V + n · P), P ≤ 7n candidate primes  
Space: O(P)

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
