## Fixed letters first

1. For each T at i: write str2 into word[i … i + m − 1]; a clash with an earlier letter → "". Mark those positions fixed.
2. Fill the other positions with a.
3. For each F at i, left to right: if the window equals str2, set its rightmost unfixed position to b; if there is none, return "".

Examples → ababa, "", a. Checked against trying every string over a–d on 600 random small cases.

Changing the leftmost free position instead: str1 = F, str2 = aa → ba instead of ab.

Time: O(n · m)  
Space: O(n + m)

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
