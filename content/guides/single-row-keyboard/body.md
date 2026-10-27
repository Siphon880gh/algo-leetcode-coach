A keyboard is a single row holding all 26 lowercase letters in some order. Your finger starts at index 0, and moving from index i to j takes |i − j| time. Return the time to type a given word. For instance, with the alphabet in order, typing `"cba"` takes 2 + 1 + 1 = 4. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Walk the row

1. `pos[c] = i` for each letter of `keyboard`.
2. `cur = 0`, `time = 0`. For each `c` in `word`: `time += abs(pos[c] − cur)`, `cur = pos[c]`.
3. Return `time`.

Do not search the keyboard for each letter; a 26-entry map is O(1). Do not start at the first letter of the word; the finger starts at index 0.

Time: O(len(word))  
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
