Given a string `s` and a list of `words`, wrap every substring of `s` that equals some word in `<b>` and `</b>`. Matches that overlap or touch must share one pair of tags. `s = "abcxyz123"`, `words = ["abc","123"]` → `"<b>abc</b>xyz<b>123</b>"`. `s = "aaabbb"`, `words = ["aa","b"]` → `"<b>aaabbb</b>"`. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## A bold mask

1. `bold = [False] * n`.
2. For each start `i` and each word `w` with `s.startswith(w, i)`, mark `bold[i : i + len(w)]` as True. Tracking the furthest end reached so far (`end = max(end, i + len(w))`, then `bold[i] = i < end`) avoids re-marking.
3. Build the output: before a bold character whose left neighbor is not bold, add `<b>`; after a bold character whose right neighbor is not bold, add `</b>`.

The mask merges overlapping and touching matches for free, because a run of True values gets one pair of tags. A trie of the words finds every match from `i` in one walk instead of checking each word.

Do not wrap each match on its own; `"aaabbb"` would become nested or repeated tags. Do not stop at the first word matching at `i`; a longer word may reach further.

Time: O(n · total word length) with `startswith`, less with a trie  
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
