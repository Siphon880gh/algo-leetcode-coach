## First occurrence of each mask

1. `first = {0: −1}`, `mask = 0`.
2. For each `i`: if `s[i]` is a vowel, flip its bit.
3. If `mask` was seen, `best = max(best, i − first[mask])`; else `first[mask] = i`.

`"eleetminicoworoep"` → 13. `"leetcodeisgreat"` → 5. `"bcbcbc"` → 6.

Do not store the latest index of a mask; the first one gives the longest span. Do not forget the initial mask 0 at index −1; whole prefixes count.

Time: O(n)  
Space: O(32)

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
