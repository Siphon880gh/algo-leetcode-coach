## Fixed window

1. Slide a window of length `minSize`, tracking letter counts and the distinct count.
2. When distinct `≤ maxLetters`, increment `freq[window]`.
3. Return the largest frequency, or 0.

`"aababcaab"`, maxLetters 2, sizes 3–4 → 2 (`"aab"`). `"aaaa"`, 1, 3–3 → 2 (overlaps count).

Do not loop over every size up to `maxSize`; it cannot beat `minSize`. Do not skip overlapping windows; they count separately.

Time: O(n · minSize) with string keys  
Space: O(n · minSize)

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
