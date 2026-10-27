## Two scans

1. pre[i] = position in t just after greedily matching s[0 … i − 1] (∞ if it fails).
2. suf[i] = latest start in t from which s[i …] still matches (−1 if it fails).
3. Return true if some i has pre[i] < suf[i + 1], else false.

Examples → true, false. Checked against trying every replacement on 20,000 random pairs.

Spending the replacement at the first character that fails: constructed check (run in code) s = "bb", t = "cb" → false instead of true.

Time: O(n + m)  
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
