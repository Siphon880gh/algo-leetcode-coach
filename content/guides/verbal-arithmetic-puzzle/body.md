## One equation

1. `weight[c] += 10^p` for each letter in a word at place `p` from the right; subtract for the result.
2. Mark letters that lead a multi-letter word or result as non-zero.
3. Backtrack: assign unused digits to letters in turn, keeping `Σ weight · digit`; return true if it is 0 at the end.
4. Prune: if the result is longer than the longest word + 1, or a word is longer than the result, return false.

`["SEND","MORE"] = "MONEY"` → true. `["SIX","SEVEN","SEVEN"] = "TWENTY"` → true. `["LEET","CODE"] = "POINT"` → false.

Do not give two letters the same digit. Do not allow a leading zero on a multi-letter word.

Time: O(10! / (10 − letters)!) worst case  
Space: O(letters)

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
