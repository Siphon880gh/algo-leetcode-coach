## One scan

1. `best = {0: 0, 1: 0}`, `run = 0`.
2. For each `i`: `run = run + 1` if `s[i] == s[i − 1]` else `1`; `best[s[i]] = max(best[s[i]], run)`.
3. Return `best[1] > best[0]`.

`"1101"` → true. `"111000"` → false. `"110100010"` → false.

Equal lengths give false (strictly longer). A missing digit has length 0, which the initial values already cover.

Time: O(n)  
Space: O(1)

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
