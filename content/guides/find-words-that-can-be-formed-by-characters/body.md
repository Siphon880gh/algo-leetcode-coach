## Compare counts

1. `have` = letter counts of `chars`.
2. For each word: `need` = its letter counts. If `need[c] ≤ have[c]` for every letter, add `len(word)`.

`["cat","bt","hat","tree"]`, `"atach"` → 3 + 3 = 6.

Do not decrement `have` across words; each word uses chars on its own. Do not only check that letters exist; a word may need a letter twice.

Time: O(total letters)  
Space: O(1) (26 letters)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Algo Learning IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
