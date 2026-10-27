Given a lowercase string `s`, remove every vowel (`a`, `e`, `i`, `o`, `u`) and return what is left. For instance, `"leetcode"` becomes `"ltcd"`. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## One pass with a vowel set

`vowels = set("aeiou")`. Return `"".join(c for c in s if c not in vowels)`.

Do not delete characters from the string one at a time; each deletion copies the rest. A regex such as `[aeiou]` replaced with `""` also works.

Time: O(n)  
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
