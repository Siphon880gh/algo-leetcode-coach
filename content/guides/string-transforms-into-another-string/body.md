Given two equal-length strings of lowercase letters, one conversion changes every occurrence of one letter in `str1` to some other lowercase letter. Return whether `str1` can become `str2` after zero or more conversions. For instance, `"aabcc"` → `"ccdee"` is possible, while `"leetcode"` → `"codeleet"` is not. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Consistent mapping

1. If `str1 == str2`, return true.
2. Build `map[str1[i]] = str2[i]`; if a letter already maps elsewhere, return false.
3. Return `len(set(str2)) < 26`.

A cycle like `a → b`, `b → a` needs a temporary letter. If `str2` uses all 26 letters, no letter is free, and every conversion would merge two letters for good.

Do not require the mapping to be one-to-one; many letters may map to the same one. Do not forget the equal-strings case, which is true even with 26 letters.

Time: O(n)  
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
