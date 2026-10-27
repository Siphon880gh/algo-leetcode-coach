## Use the runs

1. Count each letter over the whole text.
2. Split text into runs `(ch, len)`.
3. For each run: `best = max(best, min(len + 1, count[ch]))`.
4. If runs `i` and `i + 2` share `ch` and run `i + 1` has length 1: `best = max(best, min(len_i + len_{i+2} + 1, count[ch]))`.

`"ababa"` → 3, `"aaabaaa"` → 6, `"aaaaa"` → 5.

The cap matters because the letter swapped in must come from somewhere; if every copy is already in the joined runs, one end loses a letter.

Do not add 1 without the cap. Do not merge runs whose gap is longer than one letter; one swap fills one slot.

Time: O(n)  
Space: O(1) (26 letters)

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
