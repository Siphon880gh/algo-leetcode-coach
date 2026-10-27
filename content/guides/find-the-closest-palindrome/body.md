## Mirror the left half

Let `L = len(n)` and `p` = the first `ceil(L / 2)` digits. A nearby palindrome keeps nearly the same left half, so try `p − 1`, `p`, `p + 1`, each mirrored onto the right (skip the middle digit when `L` is odd). Changing the left half by more than 1 only moves further away.

Length changes need two more candidates: `10^(L−1) − 1` (`"99…9"`, one digit shorter) and `10^L + 1` (`"100…01"`, one digit longer). They cover cases like `"10"` → 9 and `"99"` → 101, where `p ± 1` changes length.

Remove `n` itself, then pick the candidate with the smallest `|c − n|`, breaking ties by the smaller `c`. Use 64-bit integers (or big integers).

Do not mirror only `p` — `"123"` mirrors to `"121"`, but `"121"` needs `"111"` or `"131"` since it cannot return itself. Do not search outward one number at a time; the gap can be huge.

Time: O(L)  
Space: O(L)

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
