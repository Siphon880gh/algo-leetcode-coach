You get a string of lowercase words separated by single spaces. Each word is expanded by writing its first letter once, its second letter twice, its third three times, and so on; the single spaces stay. Given a valid index k into the expanded string, return the character there, which may be a space. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Skip by size

1. For each word w: m = L(L + 1)/2.
2. If k = m, return " ". If k > m, k −= m + 1 and continue.
3. Otherwise walk the letters with c += i + 1 and return w[i] once k < c.

Constructed checks (made-up values, run in code): s = "ab cd" → k = 4 gives "c", k = 3 gives " "; s = "xyz", k = 5 gives "z". Checked against building the expanded string on 3,000 random cases.

Forgetting the space (k −= m): s = "ab cd", k = 4 → "d" instead of "c".

Time: O(|s|)  
Space: O(1) beyond the split

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
