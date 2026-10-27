## Translate and dedupe

With the 26 Morse codes in a table indexed by `ord(c) − ord('a')`, each word becomes `"".join(code[c] for c in word)`. Add it to a set and return the set's size.

Different words can collide because there are no separators: `"gin"` and `"zen"` both become `"--...-."`.

Do not compare words with each other; the collisions only show up after translation. Do not insert separators; the problem concatenates codes directly.

Time: O(Σ|word|)  
Space: O(Σ|word|)

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
