## Per word

For the `i`-th word `w` (starting at 1):

1. If `w[0]` is a vowel (`aeiouAEIOU`), keep `w`. Otherwise `w = w[1:] + w[0]`.
2. Append `"ma"`.
3. Append `"a" · i`.

Join the words with single spaces.

Check vowels case-insensitively; `"Apple"` starts with a vowel.

Do not count `i` from 0; the first word gets one `"a"`. Building strings with repeated concatenation is fine here; the output is O(n + words²) characters anyway.

Time: O(n + words²)  
Space: O(n + words²)

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
