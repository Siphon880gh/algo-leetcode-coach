## Include or skip each word

1. `have` = counts of `letters`; precompute each word's counts and score.
2. `go(i, total)`: at the end, update `best`. Skip word `i`; then, if `have` covers it, subtract, `go(i + 1, total + score_i)`, and add back.
3. Return `best`.

First example → 23 (`"dad"` + `"good"`). Second → 27.

Do not pick words greedily by score; a high-scoring word can block two better ones. Do not reuse letters across words; each letter is used once.

Time: O(2ⁿ · 26)  
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
